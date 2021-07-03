// Basic auth guard executed before each route change, checks if user is authenticated before route change
export default function ({redirect, store}) {
    const isAuthenticated = store.state.auth.user ? true : false
    if (!isAuthenticated) {
        redirect({name: 'login'})
    } else {
        redirect({name: 'file-upload'})
    }
}