export default function({ store, redirect }) {
  // Caso Usuário Não Logado
  if (!store.state.auth.loggedIn) {
    return redirect("/login");
  }
}
