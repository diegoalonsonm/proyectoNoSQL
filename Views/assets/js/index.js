
var config = {
    reset:  true,
    mobile: true
  }
window.sr = ScrollReveal(config);

ScrollReveal().reveal('body', {
	interval: 16,
	reset: true
});

sr.reveal('.small-carousel', {
    duration: 2000,
    reset: true
});
sr.reveal('.titulo', {
    duration: 2500,
    origin: 'left',
    distance:'400px',
    reset: true
});
sr.reveal('.text', {
    duration: 2500,
    origin: 'right',
    distance:'400px',
    reset: true
});

sr.reveal('.inf', {
    duration: 3500
    ,reset: true
});


sr.reveal('.IMG1', {
    duration: 3500,
    origin: 'left',
    distance:'40px',
    reset: true
});

sr.reveal('.IMG2', {
    duration: 3500,
    origin: 'bottom',
    distance:'10px',
    reset: true
});

sr.reveal('.IMG3', {
    duration: 3500,
    origin: 'right',
    distance:'40px',
    reset: true
});
sr.reveal('.mis', {
    duration: 3500,
    origin: 'left',
    distance:'200px',
    delay:200,
    reset: true
});
sr.reveal('.vis', {
    duration: 3500,
    origin: 'right',
    distance:'200px',
    delay:500,
    reset: true
});

sr.reveal('.historia', {
    duration: 2000,
    reset: true
});


sr.reveal('.title', {
    duration: 3500,
    origin: 'left',
    distance:'500px',
    delay:500,
    reset: true
});
sr.reveal('.texto', {
    duration: 3500,
    origin: 'right',
    distance:'500px',
    delay:500,
    reset: true
});