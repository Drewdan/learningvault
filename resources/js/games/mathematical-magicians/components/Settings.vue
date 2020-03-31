<template>
	<div>
		<div class="text-center">
			<h1>Mathematical Magicians</h1>
		</div>
		<div
			v-if="!selectedGame"
			class="row text-center font-weight-bold h1"
		>
			<div
				class="col-sm-12 col-md-6 py-5 bg-warning button-cursor"
				@click="loadLevel('PracticeLevel')"
			>
				<div class="py-5 mb-2">
					Practice Level
				</div>
			</div>
			<div class="col-sm-12 col-md-6 py-5 bg-success button-cursor">
				<div class="py-5 mb-2">
					How quick are you?
				</div>
			</div>
			<div class="col-sm-12 col-md-6 py-5 bg-info button-cursor">
				<div class="py-5 mb-2">
					Play Against Friends
				</div>
			</div>
			<div class="col-sm-12 col-md-6 py-5 bg-danger button-cursor">
				<div class="py-5 mb-2">
					Quick Fire Questions
				</div>
			</div>
		</div>
		<component
			:is="selectedGame"
			v-if="selectedGame"
		/>
	</div>
</template>
<script>
	import PracticeLevel from './PracticeLevel.vue';

	export default {
		components: {
			PracticeLevel,
		},
		data() {
			return {
				selectedGame: 'PracticeLevel',
			};
		},
		methods: {
			loadLevel(value) {
				this.selectedGame = value;
			},
		},
	};
</script>
<style>
	.button-cursor {
		cursor: pointer;
	}
</style>
