import { ApolloClient, InMemoryCache } from '@apollo/client'
import { createApolloProvider } from '@vue/apollo-option'

const cache = new InMemoryCache()

const apolloClient = new ApolloClient({
    cache,
    uri: "https://localhost:8000/graphql/"
});


export const provider = createApolloProvider({
    defaultClient: apolloClient,
})