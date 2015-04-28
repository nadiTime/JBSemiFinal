skel.init({
  containers: 1200,
  breakpoints: {
    global:{
      grid: {
        gutters: [10, 10]
      }
    },
    medium: {
      media: '(min-width: 769px) and (max-width: 1024px)',
      containers: '90%'
    },
    small: {
      media: '(max-width: 768px)',
      containers: '95%'
    },
    xsmall: {
      media: '(max-width: 480px)'
    }
  }
});