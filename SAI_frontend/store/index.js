// export const mutations = {

//     setToken(state, payload) {
//         state.token = payload
//     }
// }

export const getters = {
    loggedIn (state) {
        return state.auth.loggedIn
    },
    user (state) {
        return state.auth.user
    }
}