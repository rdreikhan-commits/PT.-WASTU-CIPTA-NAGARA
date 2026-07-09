<?php

$services = \App\Models\Service::all();
foreach($services as $srv) {
    if($srv->slug == 'perencanaan-umum-dan-masterplanning') {
        $srv->description = 'Perencanaan kawasan makro, tata kota, zonasi, dan masterplanning berkelanjutan dengan pendekatan ramah lingkungan. Layanan ini mencakup studi kelayakan tapak, analisis dampak lingkungan (AMDAL), serta perumusan desain konseptual yang mengintegrasikan aspek sosial, ekonomi, dan ekologi kawasan untuk menciptakan lingkungan binaan yang harmonis dan futuristik.';
    } elseif($srv->slug == 'perencanaan-teknik-dan-struktur') {
        $srv->description = 'Detail Engineering Design (DED), perhitungan struktur baja, beton bertulang, mekanikal, elektrikal, dan plumbing (MEP). Kami menyajikan dokumen rekayasa teknis yang komprehensif, presisi tinggi, dan memenuhi standar keamanan nasional maupun internasional, memastikan bangunan kokoh dan efisien secara operasional.';
    } elseif($srv->slug == 'perencanaan-konstruksi') {
        $srv->description = 'Penyusunan metode pelaksanaan konstruksi, estimasi biaya secara presisi (RAB), serta penyusunan dokumen lelang. Kami menyediakan layanan manajemen pengadaan (procurement) dan analisis nilai (value engineering) untuk memastikan setiap material dan langkah pengerjaan optimal tanpa mengorbankan kualitas akhir.';
    } elseif($srv->slug == 'desain-interior-premium') {
        $srv->description = 'Kreasi ruang dalam dengan estetika modern-minimalis, pemilihan material premium, pencahayaan dramatis, dan fungsionalitas tinggi. Desainer interior kami meramu tekstur, warna, dan pencahayaan (lighting design) secara khusus untuk membangkitkan suasana yang eksklusif, nyaman, dan mencerminkan identitas penghuninya.';
    } elseif($srv->slug == 'desain-eksterior-dan-arsitektur') {
        $srv->description = 'Perancangan fasad bangunan ikonik yang memiliki nilai seni tinggi, fungsionalitas termal, serta visual yang menakjubkan. Dengan mengadopsi prinsip arsitektur tropis modern, kami mendesain bangunan yang responsif terhadap iklim, mengurangi konsumsi energi, dan tetap menampilkan kemewahan melalui garis desain yang bersih.';
    } elseif($srv->slug == 'bim-modeling-dan-digital-twin') {
        $srv->description = 'Penerapan Building Information Modeling (BIM) LOD 100 hingga LOD 500 untuk visualisasi 3D, deteksi benturan (clash detection), dan estimasi kuantitas. Teknologi ini meminimalisir kesalahan lapangan (rework), mempercepat waktu pengerjaan, dan menyediakan model digital (Digital Twin) untuk kemudahan pemeliharaan gedung pasca konstruksi.';
    } elseif($srv->slug == 'project-management-consultancy') {
        $srv->description = 'Pengawasan waktu, mutu, dan biaya proyek secara komprehensif mulai dari tahap inisiasi hingga serah terima pekerjaan (handover). Tim manajer proyek kami mengadopsi standar PMI (Project Management Institute) untuk memitigasi risiko, mengkoordinir kontraktor, dan memastikan proyek selesai tepat waktu dan sesuai anggaran.';
    } elseif($srv->slug == 'lanskap-dan-desain-ekologis') {
        $srv->description = 'Perancangan ruang terbuka hijau, integrasi vegetasi lokal, konservasi air, dan optimalisasi iklim mikro kawasan. Kami menciptakan oasis di tengah kepadatan urban melalui perancangan hardscape dan softscape yang tidak hanya indah dipandang, namun juga berfungsi sebagai penyerap polutan dan peredam suhu alami.';
    }
    $srv->save();
}

echo "Berhasil memperbarui deskripsi layanan.\n";
