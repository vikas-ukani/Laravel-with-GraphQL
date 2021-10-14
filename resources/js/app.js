require('./bootstrap');
require('alpinejs');

import { createApp } from 'vue'
import router from './router';
import SkillIndex from './components/skills/SkillIndex'
import * as apolloProvider from './apollo.provider'

createApp({
    components: { SkillIndex }
})
    .use(apolloProvider.provider)
    .use(router)
    .mount('#app')