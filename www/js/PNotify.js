

document.addEventListener('DOMContentLoaded', function() {
    PNotify.defaults.styling = 'brighttheme';
    PNotify.defaults.icons = 'brighttheme';
});
function showPaginate(type) {
    if (typeof window.stackPaginate === 'undefined') {
      window.stackPaginate = new PNotify.Stack({
        dir1: 'down',
        dir2: 'left',
        firstpos1: 25,
        firstpos2: 25,
        modal: false,
        context: document.getElementById('paginate-context')
      });
    }
    const opts = {
      title: "It's a Notice",
      text: 'The notice gives you a bit more context about the other notices.',
      stack: window.stackPaginate,
      destroy: true,
      modules: new Map([
        ...PNotify.defaultModules,
        [PNotifyPaginate, {}]
      ])
    };
    switch (type) {
      case 'error':
        opts.title = 'Oh No';
        opts.text = 'Watch out for that water tower!';
        opts.type = 'error';
        break;
      case 'info':
        opts.title = 'Breaking News';
        opts.text = 'Have you met Ted?';
        opts.type = 'info';
        break;
      case 'success':
        opts.title = 'Good News Everyone';
        opts.text =
          "I've invented a device that bites shiny metal asses.";
        opts.type = 'success';
        break;
    }
    PNotify.alert(opts);
  }