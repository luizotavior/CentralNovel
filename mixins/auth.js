import Vue from 'vue'

export default class AuthMixin extends Vue {

  /**
   * This define if login got an error
   * @type {boolean}
   */
  loginHasError = false

  /**
   * Logout method using auth-module with custom post-request
   * logic, using toast module to show information, success
   * and error messages.
   *
   * @returns {Promise<void>}
   */
  async logout () {

    this.$toast.show('Logging out...')
    await this.$auth.logout().then(() => {
      this.$toast.success('Successfully disconnected')
    }).catch(err => {
      this.$toast.error('Error while disconnecting: ' + err.message)
    })

    // If you are not fond of using axios promises on async calls
    // You can still use Javascript try and catch block
    //
    // try {
    //   this.$toast.show('Logging out...')
    //   await this.$auth.logout()
    //   this.$toast.success('Successfully disconnected')
    // } catch (err) {
    //   this.$toast.error('Error while disconnecting: ' + err.message)
    // }
  }

  /**
   * Login method using auth-module with custom post-request
   * logic, using toast module to show information, success
   * and error messages.
   *
   * @returns {Promise<T>}
   */
  login() {
    this.$toast.show("Logging in...", { duration: 10000 });
  }
}