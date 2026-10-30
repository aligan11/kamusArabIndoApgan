<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Vocabulary;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class KamusSeeder extends Seeder
{
    /**
     * Format tiap kata: [arabic_text, latin_text, meaning, description, example_sentence, image_prompt, is_trending]
     *
     * @return array<string, array{icon: string, words: array<int, array<int, string|bool>>}>
     */
    private function catalog(): array
    {
        return [
            'Makanan & Minuman' => [
                'icon' => 'cutlery',
                'words' => [
                    ['تُفَّاحَة', 'tuffāḥah', 'Apel', 'Buah bulat berwarna merah atau hijau yang kaya serat dan vitamin C.', 'أَكَلْتُ تُفَّاحَةً حَمْرَاءَ هَذَا الصَّبَاحَ.', 'a single fresh red apple, studio product photo, clean light background', true],
                    ['خُبْز', 'khubz', 'Roti', 'Makanan pokok dari tepung yang dipanggang dan biasa disantap bersama lauk.', 'نَأْكُلُ الْخُبْزَ مَعَ الْإِفْطَارِ.', 'freshly baked flatbread on a wooden board, warm light, food photography', false],
                    ['مَاء', 'māʾ', 'Air', 'Cairan bening tanpa warna yang menjadi kebutuhan utama tubuh manusia.', 'أَشْرَبُ الْمَاءَ بَعْدَ الْأَكْلِ.', 'a clear glass of pure mineral water, clean bright background', true],
                    ['حَلِيب', 'ḥalīb', 'Susu', 'Minuman putih bergizi dari sapi yang kaya kalsium dan protein.', 'أَشْرَبُ الْحَلِيبَ فِي الصَّبَاحِ.', 'a glass of fresh white milk, clean minimal background', false],
                    ['قَهْوَة', 'qahwah', 'Kopi', 'Minuman berwarna gelap dari biji kopi sangrai dengan aroma yang khas.', 'أُحِبُّ الْقَهْوَةَ السَّاخِنَةَ.', 'a cup of hot black coffee with steam, moody food photography', true],
                    ['مَوْز', 'mawz', 'Pisang', 'Buah memanjang berwarna kuning dengan rasa manis dan tekstur lembut.', 'الْمَوْزُ فَاكِهَةٌ لَذِيذَةٌ.', 'a bunch of ripe yellow bananas, clean bright background', false],
                ],
            ],
            'Keluarga & Orang' => [
                'icon' => 'users',
                'words' => [
                    ['أَب', 'ab', 'Ayah', 'Orang tua laki-laki yang menjadi kepala dan penopang keluarga.', 'أَبِي رَجُلٌ كَرِيمٌ.', 'a kind middle aged father smiling warmly, portrait photo', true],
                    ['أُمّ', 'umm', 'Ibu', 'Orang tua perempuan yang melahirkan dan merawat anak-anaknya.', 'أُمِّي أَحَبُّ إِلَيَّ مِنْ كُلِّ شَيْءٍ.', 'a loving mother smiling gently, portrait photo, soft light', true],
                    ['أَخ', 'akh', 'Saudara laki-laki', 'Laki-laki yang lahir dari ibu atau ayah yang sama.', 'أَخِي يَدْرُسُ فِي الْجَامِعَةِ.', 'two young brothers standing together, candid portrait photo', false],
                    ['أُخْت', 'ukht', 'Saudara perempuan', 'Perempuan yang lahir dari ibu atau ayah yang sama.', 'أُخْتِي طَبِيبَةٌ مَاهِرَةٌ.', 'a young woman smiling confidently, portrait photo, soft light', false],
                    ['جَدّ', 'jadd', 'Kakek', 'Ayah dari ayah atau ibu kita.', 'جَدِّي يُحِبُّ الْقِرَاءَةَ.', 'an elderly grandfather smiling warmly, portrait photo', false],
                    ['صَدِيق', 'ṣadīq', 'Teman', 'Orang yang dekat, dipercaya, dan menemani dalam pergaulan sehari-hari.', 'صَدِيقِي شَخْصٌ مُخْلِصٌ.', 'two close friends laughing together, candid outdoor photo', true],
                ],
            ],
            'Rumah & Perabot' => [
                'icon' => 'home',
                'words' => [
                    ['بَيْت', 'bayt', 'Rumah', 'Bangunan tempat tinggal sekaligus tempat berlindung bagi keluarga.', 'بَيْتِي قَرِيبٌ مِنَ الْمَدْرَسَةِ.', 'a modern cozy house exterior with garden, daylight photo', true],
                    ['بَاب', 'bāb', 'Pintu', 'Penghubung antara ruang di dalam dan di luar bangunan.', 'أَغْلِقِ الْبَابَ بَعْدَ الْخُرُوجِ.', 'a wooden door with a metal handle, minimal interior photo', false],
                    ['نَافِذَة', 'nāfidhah', 'Jendela', 'Lubang pada dinding yang menjadi jalur masuknya cahaya dan udara.', 'اِفْتَحِ النَّافِذَةَ لِيَدْخُلَ الْهَوَاءُ.', 'a bright clean window with white curtains, interior photo', false],
                    ['كُرْسِيّ', 'kursī', 'Kursi', 'Perabot berkaki yang digunakan untuk duduk.', 'اِجْلِسْ عَلَى الْكُرْسِيِّ.', 'a simple wooden chair, clean product photo, white background', false],
                    ['طَاوِلَة', 'ṭāwilah', 'Meja', 'Perabot datar berkaki untuk menaruh barang atau bekerja.', 'الْكِتَابُ عَلَى الطَّاوِلَةِ.', 'a wooden table in a bright room, clean product photo', false],
                    ['مِصْبَاح', 'miṣbāḥ', 'Lampu', 'Alat penerang ruangan yang bekerja dengan energi listrik.', 'الْمِصْبَاحُ مُضِيءٌ فِي الْغُرْفَةِ.', 'a warm glowing table lamp, minimal dark photo', true],
                ],
            ],
            'Sekolah & Pendidikan' => [
                'icon' => 'academic-cap',
                'words' => [
                    ['كِتَاب', 'kitāb', 'Buku', 'Kumpulan lembaran berisi tulisan yang dijilid menjadi satu.', 'أَقْرَأُ الْكِتَابَ كُلَّ يَوْمٍ.', 'a stack of hardcover books on a wooden desk, clean photo', true],
                    ['قَلَم', 'qalam', 'Pena', 'Alat tulis berisi tinta untuk menulis atau menggambar.', 'أَكْتُبُ بِالْقَلَمِ الْأَزْرَقِ.', 'a blue ballpoint pen on white paper, clean product photo', false],
                    ['مُعَلِّم', 'muʿallim', 'Guru', 'Orang yang mengajar dan membimbing murid di sekolah.', 'الْمُعَلِّمُ شَرَحَ الدَّرْسَ.', 'a teacher explaining a lesson at a whiteboard, classroom photo', false],
                    ['طَالِب', 'ṭālib', 'Siswa', 'Orang yang sedang menuntut ilmu di sekolah atau kampus.', 'الطَّالِبُ مُجْتَهِدٌ فِي دِرَاسَتِهِ.', 'a student holding notebooks and smiling, portrait photo', false],
                    ['مَدْرَسَة', 'madrasah', 'Sekolah', 'Lembaga tempat berlangsungnya proses belajar dan mengajar.', 'أَذْهَبُ إِلَى الْمَدْرَسَةِ صَبَاحًا.', 'a school building exterior with a flag pole, daylight photo', true],
                    ['اِمْتِحَان', 'imtiḥān', 'Ujian', 'Kegiatan mengukur kemampuan setelah proses belajar selesai.', 'نَجَحْتُ فِي الْاِمْتِحَانِ.', 'students taking an exam in a bright classroom, photo', false],
                ],
            ],
            'Alam & Cuaca' => [
                'icon' => 'sun',
                'words' => [
                    ['شَمْس', 'shams', 'Matahari', 'Bintang pusat tata surya yang menjadi sumber cahaya dan panas.', 'الشَّمْسُ مُشْرِقَةٌ الْيَوْمَ.', 'bright sun shining in a clear blue sky, nature photo', true],
                    ['قَمَر', 'qamar', 'Bulan', 'Benda langit yang bersinar pada malam hari dan mengelilingi bumi.', 'الْقَمَرُ مُنِيرٌ اللَّيْلَةَ.', 'a full detailed moon in a dark night sky, astrophotography', true],
                    ['نَجْم', 'najm', 'Bintang', 'Titik cahaya jauh di langit malam yang tampak berkelip.', 'النُّجُومُ تَلْمَعُ فِي السَّمَاءِ.', 'a star filled night sky over a silhouette forest, astrophotography', false],
                    ['مَطَر', 'maṭar', 'Hujan', 'Air yang turun dari awan menuju permukaan bumi.', 'نَزَلَ الْمَطَرُ بِغَزَارَةٍ.', 'heavy rain drops falling with water splashes, close up photo', false],
                    ['بَحْر', 'baḥr', 'Laut', 'Kumpulan air asin yang sangat luas di permukaan bumi.', 'الْبَحْرُ هَادِئٌ فِي الصَّبَاحِ.', 'calm turquoise sea with a clear horizon, landscape photo', false],
                    ['جَبَل', 'jabal', 'Gunung', 'Daratan yang menjulang tinggi dan memiliki puncak.', 'الْجَبَلُ مُرْتَفِعٌ جِدًّا.', 'a tall green mountain landscape with clouds, nature photo', false],
                ],
            ],
            'Warna & Bentuk' => [
                'icon' => 'paint-brush',
                'words' => [
                    ['أَحْمَر', 'aḥmar', 'Merah', 'Warna dasar yang menyerupai warna darah dan buah cabai.', 'الْوَرْدَةُ حَمْرَاءُ.', 'a bright red rose flower close up, clean background', true],
                    ['أَزْرَق', 'azraq', 'Biru', 'Warna yang menyerupai langit cerah dan air laut.', 'السَّمَاءُ زَرْقَاءُ.', 'a clear deep blue sky above the ocean, nature photo', false],
                    ['أَخْضَر', 'akhḍar', 'Hijau', 'Warna yang menyerupai warna daun dan rerumputan.', 'الشَّجَرَةُ خَضْرَاءُ.', 'fresh green leaves close up with water drops, nature photo', false],
                    ['أَصْفَر', 'aṣfar', 'Kuning', 'Warna cerah yang menyerupai warna kunyit dan cahaya matahari.', 'اللَّيْمُونُ أَصْفَرُ.', 'a bright yellow lemon on a white background, product photo', false],
                    ['أَبْيَض', 'abyaḍ', 'Putih', 'Warna paling terang yang menyerupai warna kapas dan salju.', 'الثَّوْبُ أَبْيَضُ.', 'clean white cotton fabric texture, product photo', false],
                    ['دَائِرَة', 'dāʾirah', 'Lingkaran', 'Bentuk bulat sempurna yang setiap titiknya berjarak sama dari pusat.', 'رَسَمْتُ دَائِرَةً عَلَى الْوَرَقِ.', 'a simple black circle geometric shape on white background', false],
                ],
            ],
            'Angka & Hitungan' => [
                'icon' => 'hashtag',
                'words' => [
                    ['وَاحِد', 'wāḥid', 'Satu', 'Bilangan pertama yang menunjukkan jumlah tunggal.', 'عِنْدِي كِتَابٌ وَاحِدٌ.', 'a glossy red number one 3d shape, clean white background', false],
                    ['اِثْنَان', 'ithnān', 'Dua', 'Bilangan setelah satu, menunjukkan sepasang jumlah.', 'عِنْدِي قَلَمَانِ اِثْنَانِ.', 'a glossy blue number two 3d shape, clean white background', false],
                    ['ثَلَاثَة', 'thalāthah', 'Tiga', 'Bilangan setelah dua.', 'فِي الْغُرْفَةِ ثَلَاثَةُ كُرَاسِيَّ.', 'a glossy green number three 3d shape, clean white background', false],
                    ['أَرْبَعَة', 'arbaʿah', 'Empat', 'Bilangan setelah tiga.', 'لِلطَّاوِلَةِ أَرْبَعَةُ أَرْجُلٍ.', 'a glossy yellow number four 3d shape, clean white background', false],
                    ['خَمْسَة', 'khamsah', 'Lima', 'Bilangan setelah empat, sama dengan jumlah jari satu tangan.', 'فِي الْيَدِ خَمْسَةُ أَصَابِعَ.', 'a glossy purple number five 3d shape, clean white background', true],
                    ['عَشَرَة', 'ʿasharah', 'Sepuluh', 'Bilangan setelah sembilan.', 'عِنْدِي عَشَرَةُ أَقْلَامٍ.', 'a glossy orange number ten 3d shape, clean white background', false],
                ],
            ],
            'Kata Sifat & Perasaan' => [
                'icon' => 'heart',
                'words' => [
                    ['كَبِير', 'kabīr', 'Besar', 'Keadaan ukuran yang melebihi ukuran biasa.', 'هَذَا بَيْتٌ كَبِيرٌ.', 'a large spacious modern living room interior, wide photo', false],
                    ['صَغِير', 'ṣaghīr', 'Kecil', 'Keadaan ukuran yang kurang dari ukuran biasa.', 'هَذَا كِتَابٌ صَغِيرٌ.', 'a tiny object held between two fingers, macro photo', false],
                    ['جَمِيل', 'jamīl', 'Indah', 'Sifat yang menyenangkan ketika dilihat atau didengar.', 'الْمَنْظَرُ جَمِيلٌ جِدًّا.', 'a beautiful scenic mountain lake landscape, nature photo', true],
                    ['سَعِيد', 'saʿīd', 'Bahagia', 'Perasaan senang dan puas yang dirasakan seseorang.', 'أَنَا سَعِيدٌ بِنَجَاحِكَ.', 'a happy young person smiling with joy, portrait photo', true],
                    ['حَزِين', 'ḥazīn', 'Sedih', 'Perasaan tidak senang karena kehilangan atau kekecewaan.', 'كَانَ حَزِينًا لِفِرَاقِ صَدِيقِهِ.', 'a sad person looking down thoughtfully, moody portrait photo', false],
                    ['سَهْل', 'sahl', 'Mudah', 'Sesuatu yang tidak memerlukan usaha besar untuk dikerjakan.', 'الْاِمْتِحَانُ سَهْلٌ جِدًّا.', 'hands solving a simple wooden puzzle, clean bright photo', false],
                ],
            ],
            'Waktu & Hari' => [
                'icon' => 'clock',
                'words' => [
                    ['يَوْم', 'yawm', 'Hari', 'Satuan waktu yang lamanya dua puluh empat jam.', 'الْيَوْمُ مُشْمِسٌ وَنَشِيطٌ.', 'a desk calendar showing days of the month, clean photo', false],
                    ['أُسْبُوع', 'usbūʿ', 'Pekan', 'Satuan waktu yang terdiri dari tujuh hari.', 'سَأُسَافِرُ الْأُسْبُوعَ الْقَادِمَ.', 'a weekly planner notebook open on a desk, photo', false],
                    ['شَهْر', 'shahr', 'Bulan', 'Satuan waktu dalam kalender yang lamanya sekitar tiga puluh hari.', 'يَبْدَأُ الشَّهْرُ الْجَدِيدُ غَدًا.', 'a monthly wall calendar on a white wall, photo', false],
                    ['سَنَة', 'sanah', 'Tahun', 'Satuan waktu yang lamanya dua belas bulan.', 'دَرَسْتُ الْعَرَبِيَّةَ سَنَةً وَاحِدَةً.', 'a new year calendar with clock, clean minimal photo', false],
                    ['صَبَاح', 'ṣabāḥ', 'Pagi', 'Waktu setelah matahari terbit sampai tengah hari.', 'أَسْتَيْقِظُ فِي الصَّبَاحِ مُبَكِّرًا.', 'golden sunrise over a calm misty landscape, nature photo', true],
                    ['لَيْل', 'layl', 'Malam', 'Waktu gelap antara terbenam dan terbitnya matahari.', 'أَنَامُ فِي اللَّيْلِ مُبَكِّرًا.', 'a quiet night city with warm lights and stars, photo', false],
                ],
            ],
            'Pekerjaan' => [
                'icon' => 'briefcase',
                'words' => [
                    ['طَبِيب', 'ṭabīb', 'Dokter', 'Orang yang berprofesi memeriksa dan mengobati pasien.', 'الطَّبِيبُ يَفْحَصُ الْمَرِيضَ.', 'a doctor in a white coat with stethoscope, portrait photo', true],
                    ['مُهَنْدِس', 'muhandis', 'Insinyur', 'Orang yang merancang dan membangun bangunan atau mesin.', 'الْمُهَنْدِسُ يَبْنِي الْجِسْرَ.', 'an engineer with a safety helmet and blueprint, photo', false],
                    ['مُحَاسِب', 'muḥāsib', 'Akuntan', 'Orang yang mengurus pembukuan dan laporan keuangan.', 'الْمُحَاسِبُ يُرَاجِعُ الْحِسَابَاتِ.', 'an accountant working with financial documents and calculator, photo', false],
                    ['تَاجِر', 'tājir', 'Pedagang', 'Orang yang menjual dan membeli barang untuk memperoleh keuntungan.', 'التَّاجِرُ يَبِيعُ الْفَوَاكِهَ.', 'a shopkeeper standing at a colorful fruit market stall, photo', false],
                    ['مُزَارِع', 'muzāriʿ', 'Petani', 'Orang yang mengolah tanah dan menanam tanaman.', 'الْمُزَارِعُ يَعْمَلُ فِي الْحَقْلِ.', 'a farmer working in a green rice field, daylight photo', false],
                    ['شُرْطِيّ', 'shurṭī', 'Polisi', 'Petugas negara yang menjaga keamanan dan ketertiban masyarakat.', 'الشُّرْطِيُّ يَحْمِي الْمَدِينَةَ.', 'a police officer in uniform on duty, portrait photo', false],
                ],
            ],
            'Percakapan Harian' => [
                'icon' => 'book-open',
                'words' => [
                    ['السَّلَامُ عَلَيْكُمْ', 'as-salāmu ʿalaykum', 'Salam pembuka', 'Ucapan salam khas Arab yang berarti semoga keselamatan menyertaimu.', 'السَّلَامُ عَلَيْكُمْ وَرَحْمَةُ اللهِ.', 'two people greeting each other warmly, candid photo', true],
                    ['شُكْرًا', 'shukran', 'Terima kasih', 'Ungkapan rasa syukur atas kebaikan yang diberikan orang lain.', 'شُكْرًا جَزِيلًا عَلَى مُسَاعَدَتِكَ.', 'a person expressing gratitude with a grateful smile, photo', true],
                    ['عَفْوًا', 'ʿafwan', 'Maaf', 'Ungkapan untuk meminta maaf atau membalas ucapan terima kasih.', 'عَفْوًا، لَمْ أَسْمَعْ كَلَامَكَ.', 'a person apologizing politely with a hand gesture, photo', false],
                    ['نَعَمْ', 'naʿam', 'Ya', 'Kata untuk menyatakan persetujuan atau jawaban yang benar.', 'نَعَمْ، أَنَا مُوَافِقٌ.', 'a person nodding in agreement, close up photo', false],
                    ['مَرْحَبًا', 'marḥaban', 'Halo', 'Ungkapan ramah untuk menyambut atau menyapa seseorang.', 'مَرْحَبًا بِكَ فِي بَيْتِنَا.', 'a friendly person waving hello, candid photo', false],
                    ['إِلَى اللِّقَاء', 'ilā al-liqāʾ', 'Sampai jumpa', 'Ungkapan perpisahan yang berarti hingga bertemu kembali.', 'إِلَى اللِّقَاءِ يَا صَدِيقِي.', 'two friends waving goodbye, candid outdoor photo', false],
                ],
            ],
        ];
    }

    public function run(): void
    {
        $timestamp = now();

        foreach ($this->catalog() as $name => $data) {
            $category = Category::query()->firstOrCreate(
                ['slug' => Str::slug($name)],
                ['name' => $name, 'icon' => $data['icon']],
            );

            Vocabulary::query()->where('category_id', $category->id)->delete();

            $rows = [];

            foreach ($data['words'] as [$arabic, $latin, $meaning, $description, $example, $prompt, $trending]) {
                $rows[] = [
                    'category_id' => $category->id,
                    'arabic_text' => $arabic,
                    'latin_text' => $latin,
                    'meaning' => $meaning,
                    'description' => $description,
                    'example_sentence' => $example,
                    'image_path' => $this->imageUrl($prompt),
                    'audio_path' => null,
                    'is_trending' => $trending,
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ];
            }

            Vocabulary::query()->insert($rows);
        }
    }

    private function imageUrl(string $prompt): string
    {
        return 'https://coresg-normal.trae.ai/api/ide/v1/text_to_image?prompt='.rawurlencode($prompt).'&image_size=square';
    }
}
