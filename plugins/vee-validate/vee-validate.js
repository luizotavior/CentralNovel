import Vue from 'vue';
import ptBr from 'vee-validate/dist/locale/pt_BR';
import VeeValidate, { Validator }  from 'vee-validate';
import CpfValidator from './validators/cpf'
import Dictionary from './dictionary'

Vue.use(VeeValidate)

Validator.localize('pt_BR', ptBr);
Validator.localize(Dictionary.pt);
Validator.extend('cpf', CpfValidator)
