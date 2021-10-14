import { ref } from 'vue'
import axios from 'axios'


export default function useSkills() {

    const skills = ref([])
    const getSkills = async () => {
        let response = await axios.get('api/skills');
        skills.value = response.data.data
    }

    return {
        skills,
        getSkills,
    }
}