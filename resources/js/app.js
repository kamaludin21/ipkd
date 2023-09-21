import './bootstrap';

const container = document.getElementById('getDialog')
const hiddenDialog = document.getElementById('hide-dialog');

if(document.getElementById('modal-layout')) {
	if(container) {
    container.addEventListener('click', getDialog);
  }
	if(hiddenDialog) {
    hiddenDialog.addEventListener('click', getDialog);
  }
}

function getDialog() {
	let element = document.getElementById("modal-layout");
	if (element.classList.contains("hidden")) {
    element.classList.replace('hidden', 'flex');
	} else {
    element.classList.replace('flex', 'hidden');
	}
}
