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
  if (!store.state.auth.user.permissions.some(e => e.name === 'dashboard.show')) {
    return redirect('/')
  }
}
