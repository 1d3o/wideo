// browser detection
export function isEdge () {
  return navigator.userAgent.indexOf("Edg") > -1
}

export function isIE () {
  return navigator.userAgent.indexOf('MSIE ') > -1 || !!navigator.userAgent.match(/Trident.*rv\:11\./)
}

export function isIos () {
  return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream
}

// callback management
export function debounce(func, wait, immediate) {
  let timeout
  return function() {
    const context = this
    const args = arguments
    const later = function() {
      timeout = null
      if (!immediate) func.apply(context, args)
    }
    const callNow = immediate && !timeout
    clearTimeout(timeout)
    timeout = setTimeout(later, wait)
    if (callNow) func.apply(context, args)
  }
}

// ajax
export function postAjax(url, data, success) {
  const params = typeof data == 'string' ?
    data :
    Object.keys(data).map(k => encodeURIComponent(k) + '=' + encodeURIComponent(data[k])).join('&')

  const xhr = new XMLHttpRequest()
  xhr.open('POST', url)
  xhr.onreadystatechange = function() {
    if (xhr.readyState>3 && xhr.status==200) { success(xhr.responseText) }
  };
  xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest')
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
  xhr.send(params)
  return xhr
}

// assets loading
export function loadScript (src, cb) {
  const script = document.createElement('script')
  script.addEventListener('load', () => {
    if (cb) cb()
  })
  script.addEventListener('error', () => {
    console.log('Failed to load script ' + src)
    if (cb) cb()
  })
  script.src = src
  document.head.appendChild(script)
}