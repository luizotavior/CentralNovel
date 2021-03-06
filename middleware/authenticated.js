export default function ({
  store,
  redirect,
  route
}) {
  // Caso Usuário Não Logado
  if (!store.state.auth.loggedIn) {
    if (process.browser) {
      localStorage.redirect = route.path
    }
    return redirect('/login')
  }
}
