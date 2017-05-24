export default {
  enableBtn(selector) {
    $(selector).attr('disabled', false)
  },
  disableBtn(selector) {
    $(selector).attr('disabled', 'disabled')
  }
}
