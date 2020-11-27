export default function ({
  store,
  redirect,
  route
}) {
  if(route.meta[0] && route.meta[0].permissions){
    route.meta[0].permissions.map((permission) => {
        if (!store.state.auth.user.permissions.some(e => e.name === permission)) {
          return redirect('/')
      }
    })
  }
}
