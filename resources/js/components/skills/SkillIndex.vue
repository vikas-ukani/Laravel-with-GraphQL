<template>
    <div>
        Hello
        <pre>
           asd asd {{ fetchSkills || json }}
        </pre>
    </div>
</template>

<script>
import { onMounted } from "vue";
import useSkills from "../../composable/skills";
import gql from "graphql-tag";

export default {
    apollo: {
        fetchSkills: {
            query: gql`
            query{
                skills {
                    id,
                    skill_title
                }
            }`,
        },
    },
    data() {
        return {
            fetchSkills: [],
        };
    },

    // setup() {
        // const { skills, getSkills } = useSkills();
        // console.log("skills", skills);
        // onMounted(getSkills);

        // return { skills };
    // },
};
</script>
