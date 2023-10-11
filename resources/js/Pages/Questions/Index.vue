<script>

export default {
	data() {
		return {
			selectedChoices: [], // Stocke les ID des choix de réponse sélectionnés pour chaque question
		};
	},

	methods: {
		submitAnswer() {
			// Envoyer les réponses au serveur
			this.$inertia.post('/submitAnswer', {
				possible_answer_id: this.selectedChoices,
			});
		},
	},
};

import { ref, onBeforeMount } from 'vue';

// defineProps(['quiz']);
const quiz = defineProps(['quiz']); // Les questions provenant du contrôleur

let nbr = ref(0);
const prevActif = ref(true);
const nextActif = ref(false);
const submitActif = ref(true);



let quizReal = [];

function changer() {
	for (let i = 0; i < quiz.quiz.question.length; i++) {
		quizReal.push(quiz.quiz.question[i]);
		for (let u = 0; u < quiz.quiz.possible_answer.length; u++) {
			quizReal[i].possible_answers = quiz.quiz.possible_answer.filter(el => el.question_id == quizReal[i].id)
		}

	}
	return quizReal;
}

onBeforeMount(() => {
	changer();
})



const next = (tableau) => {
	nbr.value++;
	if (nbr.value >= 1) {
		prevActif.value = false
	}
	if (nbr.value >= 19) {
		nextActif.value = true
		submitActif.value = false
	}
}

const preview = (tableau) => {
	nbr.value--;
	if (nbr.value < 1) {
		prevActif.value = true
	}
	if (nbr.value <= 19) {
		nextActif.value = false
		submitActif.value = true
	}
	else if (nbr.value < tableau.length) {

	}
}

const submit = () => {

}



</script>
 
<template>

	<!-- <template #header> -->
	<h2 class="font-semibold text-xl text-gray-800 leading-tight">
		Questions
	</h2>
	<!-- </template> -->

	<div class="py-12">
		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 text-gray-800">
			<div>
				<div class="flex justify-between font-bold text-2xl border-b-4 border-gray-800">
					<p class="">{{ quiz.title }}</p>
					<p class="">00:00</p>
				</div>

				<div class="container mx-auto max-w-3xl mt-6">
					<div class="border-solid border-2 rounded-lg bg-white">
						<p>Formulaire</p>

						<form method="post"
							@submit.prevent="form.post(route('userAnswer.store'), { onSuccess: () => form.reset() })">
							<div class="items-center" v-for="question in changer()" :key="question.id">
								<h3>{{ question.texte }}</h3>

								<div v-for="possible_answer in question.possible_answers ">
									<ul>
										<!-- <li class="flex"> <Checkbox /> <InputLabel>{{ possible_answer.text }}</InputLabel></li> -->
										<li>
											<input type="checkbox" id="possible_answer" :key="possible_answer.id"
												:value="possible_answer.id" v-model="SecletedAnswer">
											<label for="possible_answer"> {{ possible_answer.id }} - {{
												possible_answer.text
											}}</label>
										</li>
									</ul> <br>
								</div>
							</div>
							<button @click.prevent="preview(questions)" :class="{ hidden: prevActif }">
								Précédent
							</button>
							<button @click.prevent="next(questions)" :class="{ hidden: nextActif }">
								Suivant
							</button>
							<button @click.prevent="submit" :class="{ hidden: submitActif }"
								class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
								soumettre
							</button>
							<!-- <PrimaryButton class="mt-4">Soumettre</PrimaryButton> -->
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>