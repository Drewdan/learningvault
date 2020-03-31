<template>
	<div>
		<div class="row h1 text-center justify-content-md-center">
			<div class="col-sm-12 col-md-6 bg-primary text-light">
				<div class="row my-3">
					<div class="col-sm-12">
						1 + 1 = {{ answer }}
					</div>
				</div>
				<div class="row">
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(7)"
					>
						7
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(8)"
					>
						8
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(9)"
					>
						9
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(4)"
					>
						4
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(5)"
					>
						5
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(6)"
					>
						6
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(1)"
					>
						1
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(2)"
					>
						2
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(3)"
					>
						3
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="clearAnswer"
					>
						Clear
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="appendToAnswer(0)"
					>
						0
					</div>
					<div
						class="col-4 border border-dark py-4 pointer"
						@click="submitAnswer"
					>
						Enter
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				timer: null,
				answer: '',
				questions: [],
			};
		},
		methods: {
			startGame() {
				

			},
			appendToAnswer(value) {
				this.answer += '' + value;
			},
			clearAnswer() {
				this.answer = '';
			},
			submitAnswer() {

			},
		},
	};
</script>
<style>
	.pointer {
		cursor: pointer;
	}
</style>
