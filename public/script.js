document.addEventListener('DOMContentLoaded', function () {
    // Fungsi untuk menambahkan input baru
    function addTagInput(input) {
        const container = document.getElementById('tags-container');
        const allInputs = container.querySelectorAll('input[name="tags[]"]');
        const lastInput = allInputs[allInputs.length - 1];

        if (input === lastInput && input.value.trim() !== '') {
            // Buat input baru
            const newInput = document.createElement('input');
            newInput.type = 'text';
            newInput.name = 'tags[]';
            newInput.className = 'form-input mt-2 w-full';
            newInput.placeholder = `Tag ${allInputs.length + 1} (Opsional)`;
            newInput.oninput = function () {
                addTagInput(newInput);
            };

            // Tambahkan input baru ke container
            container.appendChild(newInput);
        }
    }

    // Tambahkan event listener ke input pertama
    const firstInput = document.querySelector('#tags-container input[name="tags[]"]');
    if (firstInput) {
        firstInput.oninput = function () {
            addTagInput(firstInput);
        };
    }
});
