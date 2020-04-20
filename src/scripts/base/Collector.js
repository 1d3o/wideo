class Collector {
  constructor () {
    this.instances = {}
  }

  get (name, ...props) {
    let res = this.instances[name]
    if (res) {
      for (let i = 0; i < props.length; i++) {
        const prop = props[i]
        if (res.hasOwnProperty(prop)) {
          res = res[prop]
        } else {
          i = props.length
          console.warn(`Property ${prop} of instance with name ${name} not found`)
        }
      }
    } else {
      console.warn(`Instance with name ${name} not found`)
    }
    return res
  }

  add (name, instance) {
    if (!this.instances.hasOwnProperty(name)) {
      this.instances[name] = instance
    } else {
      console.warn(`Instance with name ${name} already exists`)
    }
  }

  remove (name) {
    if (this.instances.hasOwnProperty(name)) {
      delete this.instances[name]
    }
  }

  map (funcName, ...args) {
    for (const key in this.instances) {
      this.instances[key] && this.instances[key][funcName] && this.instances[key][funcName](...args)
    }
  }

  call (name, funcName, ...args) {
    const instance = this.get(name)
    return instance && instance[funcName] && instance[funcName](...args)
  }
}

const collector = new Collector()
export default collector