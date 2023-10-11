
<script>
export default {
	data() {
		return {
			selectedChoices: [], // Stocke les ID des choix de réponse sélectionnés pour chaque question
		};
	},
	props: {
		quiz: Array, // Les questions provenant du contrôleur
	},
	methods: {
		submitAnswer() {
			// Envoyer les réponses au serveur
			this.$inertia.post('/submitAnswer', {
				answers: this.selectedChoices,
			});
		},
	},
};

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


</script>

<template>

	<h2>Questions</h2>

	<div class="py-12">

		<div class="max-w-5xl mx-auto sm:px-6 lg:px-8 text-gray-800">
			<div>
				<div class="flex justify-between font-bold text-2xl border-b-4 border-gray-800">
					<h3>Titre</h3>
					<p class="">00:00</p>
				</div>

				<div class="container mx-auto max-w-4xl mt-6">
					<div class="border-solid border-2 rounded-lg bg-white">
						<form @submit="submitAnswer" method="post">
							<div v-for="questions in quiz.question">
								<h3> <pre>Question: {{ questions.text }}</pre> </h3>

								<div v-for="possible_answer in quiz.possible_answer">
									<input type="checkbox" id="answer"  :value="possible_answer.id">
									<label for="answer"> {{ possible_answer.text }} </label>
								</div>

							</div>
							<button type="submit"
								class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Soumettre</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>