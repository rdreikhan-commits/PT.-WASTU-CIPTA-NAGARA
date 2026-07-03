@extends('layouts.admin')

@section('header_title', 'Pengaturan Website Global')

@section('content')

    <div class="card border-0 shadow-sm bg-white p-4">
        <h5 class="font-head fw-bold mb-4 border-bottom pb-2">Edit Informasi Website</h5>
        
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf
            
            <div class="row g-4">
                
                <!-- 1. General Profile -->
                <div class="col-12">
                    <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Profil Umum Perusahaan</h6>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Nama Perusahaan</label>
                    <input type="text" name="company_name" class="form-control rounded-0" value="{{ $settings['company_name'] ?? '' }}" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Slogan / Tagline</label>
                    <input type="text" name="company_tagline" class="form-control rounded-0" value="{{ $settings['company_tagline'] ?? '' }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Alamat Lengkap Kantor</label>
                    <textarea name="company_address" rows="2" class="form-control rounded-0">{{ $settings['company_address'] ?? '' }}</textarea>
                </div>

                <!-- 2. Contacts -->
                <div class="col-12 mt-5">
                    <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Kontak & Lokasi</h6>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Email Resmi</label>
                    <input type="email" name="company_email" class="form-control rounded-0" value="{{ $settings['company_email'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Telepon Kantor</label>
                    <input type="text" name="company_phone" class="form-control rounded-0" value="{{ $settings['company_phone'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">WhatsApp (Format: 6281...)</label>
                    <input type="text" name="company_whatsapp" class="form-control rounded-0" value="{{ $settings['company_whatsapp'] ?? '' }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Google Maps Iframe Embed URL</label>
                    <input type="text" name="company_maps" class="form-control rounded-0" value="{{ $settings['company_maps'] ?? '' }}">
                    <small class="text-muted">Masukkan tautan `src` dari iframe Google Maps.</small>
                </div>

                <!-- 3. Socials -->
                <div class="col-12 mt-5">
                    <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Tautan Media Sosial</h6>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">LinkedIn Company Page</label>
                    <input type="url" name="social_linkedin" class="form-control rounded-0" value="{{ $settings['social_linkedin'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">Instagram Profile</label>
                    <input type="url" name="social_instagram" class="form-control rounded-0" value="{{ $settings['social_instagram'] ?? '' }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-bold text-uppercase">YouTube Channel</label>
                    <input type="url" name="social_youtube" class="form-control rounded-0" value="{{ $settings['social_youtube'] ?? '' }}">
                </div>

                <!-- 4. SEO defaults -->
                <div class="col-12 mt-5">
                    <h6 class="font-head text-gold text-uppercase fw-bold mb-3" style="font-size: 0.8rem; letter-spacing: 0.05em;">Optimasi SEO Default (Search Engine Optimization)</h6>
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Default Meta Title</label>
                    <input type="text" name="seo_meta_title" class="form-control rounded-0" value="{{ $settings['seo_meta_title'] ?? '' }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label small fw-bold text-uppercase">Default Meta Keywords</label>
                    <input type="text" name="seo_meta_keywords" class="form-control rounded-0" value="{{ $settings['seo_meta_keywords'] ?? '' }}">
                </div>
                <div class="col-12">
                    <label class="form-label small fw-bold text-uppercase">Default Meta Description</label>
                    <textarea name="seo_meta_description" rows="3" class="form-control rounded-0">{{ $settings['seo_meta_description'] ?? '' }}</textarea>
                </div>

                <div class="col-12 mt-5">
                    <button type="submit" class="btn btn-gold w-100 py-3">SIMPAN PENGATURAN</button>
                </div>
                
            </div>
            
        </form>
    </div>

@endsection
