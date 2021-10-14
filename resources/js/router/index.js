import { createRouter, createWebHistory } from 'vue-router'
import SkillIndex from '../components/skills/SkillIndex'

const routes = [
    {
        path: "/dashboard",
        component: SkillIndex,
        name: "dashboard"
    }
]
export default createRouter({
    history: createWebHistory(),
    routes
})