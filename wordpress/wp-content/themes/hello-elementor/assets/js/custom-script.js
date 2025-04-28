  // setTimeout(function () {
  //   document.querySelectorAll('.sr7-thumb-img').forEach(el => {
  //     const bg = window.getComputedStyle(el).backgroundImage;
  //     console.log('Before:', bg);
  
  //     const match = bg.match(/url\(["']?(.*?)(-50x100)(\.\w{3,4})["']?\)/i);
  //     if (match) {
  //       const cleanUrl = match[1] + match[3];
  //       el.style.backgroundImage = `url("${cleanUrl}")`;
  //       console.log('After:', el.style.backgroundImage);
  //     } else {
  //       console.warn('No match found:', bg);
  //     }
  //   });
  // }, 1000);
  
  
  (function() {
    function cleanThumbBackgrounds() {
      document.querySelectorAll('.sr7-thumb-img').forEach(el => {
        const bg = window.getComputedStyle(el).backgroundImage;
        console.log('Before:', bg);
  
        const match = bg.match(/url\(["']?(.*?)(-50x100)(\.\w{3,4})["']?\)/i);
        if (match) {
          const cleanUrl = match[1] + match[3];
          el.style.backgroundImage = `url("${cleanUrl}")`;
          console.log('After:', el.style.backgroundImage);
        } else {
          console.warn('No match found:', bg);
        }
      });
    }

    if (document.readyState === 'complete') {
      cleanThumbBackgrounds();
    } else {
      window.addEventListener('load', cleanThumbBackgrounds);
    }
  })();
  