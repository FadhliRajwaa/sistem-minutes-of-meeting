<?= $this->extend('Layouts/main') ?>
<?= $this->section('content') ?>

<style>
    body {
        background-image: url('/images/batik.avif');
        background-size: cover;
        background-attachment: fixed;
    }

    .glass {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(10px);
    }
</style>

<div class="max-w-4xl mx-auto mt-10 p-6 rounded-xl shadow-lg glass">

    <h2 class="text-3xl font-bold mb-8 text-center text-blue-800">Add Discussion</h2>

    <form action="<?= base_url('/discussion/save') ?>" method="post" id="discussionForm">
        <?= csrf_field() ?>

        <!-- Topik dan Tanggal -->
        <div class="grid md:grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block font-semibold mb-4 text-gray-700">Topik Rapat</label>
                <input type="text" name="topic" class="w-full p-3 rounded border border-blue-300" placeholder="Masukkan topik rapat" required>
            </div>
            <div>
                <label class="block font-semibold mb-2 text-gray-700">Tanggal</label>
                <input type="date" name="date" class="w-full p-3 rounded border border-blue-300" required>
            </div>
        </div>

        <!-- Slide (Catatan) -->
        <div class="mb-6">
            <label class="block font-semibold mb-2 text-gray-700">Catatan</label>
            <textarea name="slides[]" rows="6" class="w-full p-4 rounded border border-blue-300" placeholder="Tulis poin diskusi seperti slide PowerPoint..." required></textarea>
        </div>

        <!-- Tombol Submit -->
        <div class="text-center mt-6">
            <button type="submit" class="bg-green-600 text-black px-6 py-3 rounded-lg hover:bg-green-700 shadow-md">
                Save Discussion
            </button>
        </div>
    </form>
</div>

<?= $this->endSection() ?>
