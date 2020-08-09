class Layout {
  constructor () {
    this.device = 0
    this.window = {
      width: 0,
      height: 0,
      ratio: 0
    }
  }

  updateWindow () {
    this.window.width = document.body.scrollWidth
    this.window.height = window.innerHeight
    this.window.ratio = this.window.width / this.window.height
  }

  updateDevice () {
    this.device = window.matchMedia('(max-width:767px)').matches ? 0 : (window.matchMedia('(max-width:1023px)').matches ? 1 : 2)
  }

  update () {
    this.updateWindow()
    this.updateDevice()
  }
}

const layout = new Layout()
export default layout