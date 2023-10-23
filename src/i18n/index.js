import { createI18n } from 'vue-i18n'
import messages from './messages'
const savedLocale = localStorage.getItem('selectedLocale');
const i18n = createI18n({
    legacy: false,
    locale: savedLocale || 'es',// set locale  
    messages, // set locale messages
    // If you need to specify other options, you can set other options
    // ...
})

export default i18n