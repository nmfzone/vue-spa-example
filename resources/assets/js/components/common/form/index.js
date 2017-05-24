export default class {

    constructor(fields = {}) {
        this.fields = fields
        this.errors = {}
    }

    setFields(fields) {
      this.fields = fields
    }

    getFields() {
      return this.fields
    }

    setErrors(errors, onIndex = null) {
      _.forEach(errors, (value, key) => {
        Vue.set(
          this.errors,
          key,
          onIndex != null ? value[onIndex] : value
        )
      })
    }

    getErrors() {
      return this.errors
    }

    emptyErrors() {
      _.forEach(this.fields, (value) => {
        Vue.set(this.errors, value, null)
      })
    }

}
