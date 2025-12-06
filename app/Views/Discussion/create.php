<?= $this->extend('Layouts/main') ?>
<?= $this->section('content') ?>

<!-- Tambahkan Tailwind CDN (jika belum ada di layout/main) -->
<style>
    body {
        background-image: url('/images/bg-meeting.jpg'); /* ganti dengan path backgroundmu */
        background-size: cover;
        background-attachment: fixed;
    }

    .glass {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
    }
</style>

<div class="max-w-4xl mx-auto mt-10 p-6 rounded-xl shadow-lg glass">

    <h2 class="text-3xl font-bold mb-6 text-center text-blue-800">Add Discussion</h2>

    <form action="<?= base_url('/discussion/save') ?>" method="post" id="discussionForm">
        <?= csrf_field() ?>

        <!-- Topik dan Tanggal -->
        <div class="grid md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-semibold mb-2">Topik Rapat</label>
                <input type="text" name="topic" class="w-full p-3 rounded border" required>
            </div>
            <div>
                <label class="block font-semibold mb-2">Tanggal</label>
                <input type="date" name="date" class="w-full p-3 rounded border" required>
            </div>
        </div>

        <!-- Slide Container -->
        <div id="slidesContainer" class="space-y-6">
            <div class="slide-item bg-white p-4 rounded shadow">
                <label class="font-semibold mb-2 block">Slide 1</label>
                <textarea name="slides[]" rows="4" class="w-full p-3 rounded border" placeholder="Tulis poin diskusi..."></textarea>
                <button type="button" onclick="removeSlide(this)" class="mt-2 text-red-500 hover:underline">Hapus Slide</button>
            </div>
        </div>

        <!-- Tombol Tambah Slide -->
        <div class="text-center my-4">
            <button type="button" onclick="addSlide()" class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
                + Tambah Slide
            </button>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center mt-6">
            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">
                Simpan Diskusi
            </button>
        </div>
    </form>
</div>

<!-- Script JS Tambah/Hapus Slide -->
<script>
    let slideCount = 1;

    function addSlide() {
        slideCount++;
        const container = document.getElementById('slidesContainer');
        const div = document.createElement('div');
        div.className = 'slide-item bg-white p-4 rounded shadow';
        div.innerHTML = `
            <label class="font-semibold mb-2 block">Slide ${slideCount}</label>
            <textarea name="slides[]" rows="4" class="w-full p-3 rounded border" placeholder="Tulis poin diskusi..."></textarea>
            <button type="button" onclick="removeSlide(this)" class="mt-2 text-red-500 hover:underline">Hapus Slide</button>
        `;
        container.appendChild(div);
    }

    function removeSlide(button) {
        const parent = button.closest('.slide-item');
        parent.remove();
    }
</script>

<?= $this->endSection() ?>
