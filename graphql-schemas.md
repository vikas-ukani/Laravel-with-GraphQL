
```
Name: Login GraphQL
URL: http://localhost:8000/graphiql/login
Schema: 
mutation login {
  login(email: "tina59@example.net", password: "password") {
    id
    name
    email
    tasks {
      id
      user_id
      title
      is_completed
    }
    token
  }
}


Name: Register GraphQL
URL: http://localhost:8000/graphiql/register
Schema: 
mutation register {
  register(name:"Vikas", email:"vikas@mail.com", password:"password" ){
    id, name, email, token
  }
}


--------------------- TESTING ---------------------

query getSkills {
  skills {
    skill_title
    id
  }
}



query myProfile {
  myprofile {
    id
    name
    email
  }
}

query getSkillsById {
  skills(id: 302) {
    skill_title
    id
  }
}

mutation updateSkill {
  updateSkill(id: 301, skill_title: "31 New Updated GraphQL Skil") {
    id
    skill_title
  }
}

mutation register{
    register(name: "jelenavuc" , email: "jelenavuc@gmail.com", password: "12345678") {
        id, name, email
    }
}



