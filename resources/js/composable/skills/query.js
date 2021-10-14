import gql from "graphql-tag";


export default {
    apollo: {
        fetchSkills: {
            query: gql`
            query{
                skills {
                     id, skill_title
                    }
                }
            }`
        }
    }
}