import Vue from 'vue';
import {
  ValidationObserver,
  ValidationProvider,
  extend
} from 'vee-validate';
import * as rules from 'vee-validate/dist/rules';
import {
  messages
} from 'vee-validate/dist/locale/pt_BR.json';


Object.keys(rules).forEach(rule => {
  extend(rule, {
    ...rules[rule], // copies rule configuration
    message: messages[rule] // assign message
  });
});
// Register it globally
Vue.component('ValidationObserver', ValidationObserver);
Vue.component('ValidationProvider', ValidationProvider);
