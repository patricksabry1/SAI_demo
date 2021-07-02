export const state = () => ({
    authenticated: false
})

export const mutations = {
    setAuth(state, payload) {
        state.authenticated = payload
    }
}