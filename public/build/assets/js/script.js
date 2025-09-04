// SCRIPT PENDIDIKAN
document.addEventListener('DOMContentLoaded', function () {
    let educationIndex = 1; // index pertama sudah 0
    const jenjangOptions = document.getElementById('jenjang-options').innerHTML;

    // Update nomor & name input setelah tambah/hapus
    function updateEducationNumbers() {
        const items = document.querySelectorAll('.education-item');
        items.forEach((item, index) => {
            const numberElement = item.querySelector('.education-number span');
            const numberIcon = item.querySelector('.education-number i');
            if (numberElement) numberElement.textContent = `Pendidikan ${index + 1}`;
            if (numberIcon) numberIcon.className = `mdi mdi-numeric-${index + 1}-circle`;

            // update semua input name dengan index baru
            const inputs = item.querySelectorAll('input, select');
            inputs.forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    const newName = name.replace(/\[\d+\]/, `[${index}]`);
                    input.setAttribute('name', newName);
                }
            });
        });
    }

    // Tambah pendidikan baru
    document.getElementById('add-pendidikan').addEventListener('click', function () {
        const wrapper = document.getElementById('pendidikan-wrapper');
        const addButtonContainer = this.parentElement;

        const newItem = document.createElement('div');
        newItem.classList.add('education-item');

        newItem.innerHTML = `
            <div class="purple-card">
                <div class="education-card-header">
                    <div class="education-number">
                        <i class="mdi mdi-numeric-${educationIndex + 1}-circle"></i>
                        <span>Pendidikan ${educationIndex + 1}</span>
                    </div>
                    <button type="button" class="btn-remove-education" data-tooltip="Hapus Pendidikan">
                        <i class="mdi mdi-close"></i>
                    </button>
                </div>
                <div class="form-grid">
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="mdi mdi-school-outline"></i>
                            Jenjang Pendidikan
                        </label>
                        <select name="pendidikan[${educationIndex}][id_jjg]" class="form-select-modern" required>
                            ${jenjangOptions}
                        </select>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="mdi mdi-domain"></i>
                            Nama Institusi <span class="required">*</span>
                        </label>
                        <input type="text" name="pendidikan[${educationIndex}][nama_pend]" class="form-input-modern"
                            placeholder="Nama Sekolah / Universitas / Institut" required>
                    </div>
                    <div class="form-group-modern">
                        <label class="form-label-modern">
                            <i class="mdi mdi-calendar-range"></i>
                            Tahun Pendidikan <span class="required">*</span>
                        </label>
                        <input type="number" name="pendidikan[${educationIndex}][thn_pend]" class="form-input-modern"
                            placeholder="Contoh: 2010" min="1980" max="2030" required>
                    </div>
                </div>
            </div>
        `;

        wrapper.insertBefore(newItem, addButtonContainer);
        educationIndex++;
        updateEducationNumbers();
    });

    // Hapus pendidikan
    document.addEventListener('click', function (e) {
        if (e.target.closest('.btn-remove-education')) {
            const educationItem = e.target.closest('.education-item');
            const educationItems = document.querySelectorAll('.education-item');

            if (educationItems.length <= 1) {
                alert('Minimal satu pendidikan harus ada!');
                return;
            }

            educationItem.remove();
            updateEducationNumbers();
        }
    });

    // initial numbering
    updateEducationNumbers();
});

// SCRIPT PREVIEW FOTO
const fotoInput = document.getElementById('foto');
const previewImg = document.getElementById('preview-foto');

fotoInput.addEventListener('change', function () {
    const file = this.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.setAttribute('src', e.target.result);
        }
        reader.readAsDataURL(file);
    }
});
