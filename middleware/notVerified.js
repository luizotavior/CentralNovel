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
    return redirect("/login");
  }
  // Caso Usuário Não tenha passado pelas Welcome
  if (store.state.auth.user.email_verified_at != null) {
    return redirect("/");
  }
}
