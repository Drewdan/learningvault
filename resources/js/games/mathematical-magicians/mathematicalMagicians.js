import Vue from 'vue';
import Axios from 'axios';
import MathematicalMagicians from './MathematicalMagicians.vue';

window.axios = Axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

new Vue({ // eslint-disable-line no-undef, no-new
	el: '#mathematical-magicians',
	render: h => h(MathematicalMagicians),
});
