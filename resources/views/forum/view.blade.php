@extends('layout.templateuser')

@section('container')
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">
            <div class="section-title" data-aos="fade-up">
                <h2>Detail Forum</h2>
            </div>
            <div class="row" data-aos="fade-up" data-aos-delay="100">
                <div class="col-auto">
                    @if ($forum->user && $forum->user->profile_image)
                        <!-- Menampilkan gambar profil pengguna jika tersedia -->
                        <img src="{{ asset('storage/' . $forum->user->profile_image) }}" class="testimonial-img"
                            alt="Foto Profil" height="50px">
                    @else
                        <!-- Menampilkan gambar default jika tidak ada gambar profil -->
                        <img src="{{ asset('storage/profile_images/default/user.png') }}" class="testimonial-img"
                            alt="Foto Profil" height="50px">
                    @endif
                </div>
                <div class="col">
                    <h4><b>
                            @if ($forum->user)
                                {{ $forum->user->name }}
                            @else
                                User
                            @endif
                        </b> : {{ $forum->judul }}</h4>
                    <h6 class="timestamp small">{{ $forum->created_at->diffForHumans() }}</h6>
                    <br>
                    <p>{{ $forum->konten }}</p>
                </div>
            </div>

            <div class="btn-group">
                <button class="btn btn-primary btn-sm mb-3" onclick="toggleKomentar()"><i class="ri-chat-1-line"></i>
                    Komentar</button>
                <span style="padding-left: 1em">{{ $forum->komentar()->count() }} </span>&nbsp; komentar
            </div>
            <form action="" method="POST">
                @csrf
                <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                <input type="hidden" name="parent" value="0">
                <div id="komentar-container" style="display: none;">
                    <textarea class="form-control mb-3" name="konten" id="komentar-utama" rows="4" required></textarea>
                    <input type="submit" class="btn btn-primary" value="Kirim">
                </div>
            </form>
            <h3 style="margin-top: 1em">Komentar</h3>

            @foreach ($forum->komentar()->where('parent', 0)->orderBy('created_at', 'desc')->get() as $komentar)
                <div class="row mt-3" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-auto">
                        @if ($komentar->user && $komentar->user->profile_image)
                            <!-- Menampilkan gambar profil pengguna jika tersedia -->
                            <img src="{{ asset('storage/' . $komentar->user->profile_image) }}" class="testimonial-img"
                                alt="Foto Profil" height="50px">
                        @else
                            <!-- Menampilkan gambar default jika tidak ada gambar profil -->
                            <img src="{{ asset('storage/profile_images/default/user.png') }}" class="testimonial-img"
                                alt="Foto Profil" height="50px">
                        @endif
                    </div>
                    <div class="col">
                        @if ($komentar->user)
                            <h5 style="color: blue;">
                                {{ $komentar->user->name }}
                            </h5>
                        @endif
                        <p>{{ $komentar->konten }}</p>
                        <h6 class="timestamp small mt-3">{{ $komentar->created_at->diffForHumans() }}</h6>
                    </div>

                    <form action="" method="POST" style="padding-left: 7em">
                        @csrf
                        <input type="hidden" name="forum_id" value="{{ $forum->id }}">
                        <input type="hidden" name="parent" value="{{ $komentar->id }}">
                        <input type="text" name="konten" class="form-control" required>
                        <input type="submit" class="btn btn-primary btn-sm mt-3" value="Kirim">
                    </form>
                    {{-- <div class="mt-2" style="padding-left: 7em">
                        <!-- Menampilkan tombol edit dan hapus jika pengguna adalah pemilik komentar atau admin -->
                        @if (auth()->check() && (auth()->user()->id === $komentar->nip || auth()->user()->role === 'Admin'))
                            <div class="col">
                                <a href="{{ route('edit_komentar', ['komentar' => $komentar->id]) }}"
                                    class="btn btn-sm btn-warning btn-sm">Edit</a>
                                <a href="{{ route('hapus_komentar', ['komentar' => $komentar->id]) }}"
                                    class="btn btn-sm btn-danger btn-sm">Hapus</a>
                            </div>
                        @endif
                    </div> --}}
                    <div class="col mt-3">
                        @foreach ($komentar->child()->orderBy('created_at', 'desc')->get() as $ch)
                            <div class="row mt-3 ml-6">
                                <div class="col-auto">
                                    @if ($ch->user && $ch->user->profile_image)
                                        <!-- Menampilkan gambar profil pengguna jika tersedia -->
                                        <img src="{{ asset('storage/' . $ch->user->profile_image) }}"
                                            class="testimonial-img" alt="Foto Profil" height="25px">
                                    @else
                                        <!-- Menampilkan gambar default jika tidak ada gambar profil -->
                                        <img src="{{ asset('storage/profile_images/default/user.png') }}" class="testimonial-img"
                                alt="Foto Profil" height="20px">
                                    @endif
                                </div>
                                <div class="col">
                                    @if ($ch->user && $ch->user->name)
                                        <h5 style="color: blue;">
                                            {{ $ch->user->name }}
                                        </h5>
                                    @endif
                                    <p>{{ $ch->konten }}</p>
                                    <h6 class="timestamp small mt-3">{{ $ch->created_at->diffForHumans() }}</h6>
                                </div>
                            </div>
                            @foreach ($ch->child()->orderBy('created_at', 'desc')->get() as $reply)
                                <div class="row mt-3 ml-9">
                                    <div class="col-auto">
                                        @if ($reply->user && $reply->user->profile_image)
                                            <!-- Menampilkan gambar profil pengguna jika tersedia -->
                                            <img src="{{ asset('storage/' . $reply->user->profile_image) }}"
                                                class="testimonial-img" alt="Foto Profil" height="25px">
                                        @else
                                            <!-- Menampilkan gambar default jika tidak ada gambar profil -->
                                            <img src="{{ asset('storage/profile_images/default/user.png') }}"
                                                class="testimonial-img" alt="Foto Profil" height="25px">
                                        @endif
                                    </div>
                                    <div class="col">
                                        @if ($reply->user && $reply->user->name)
                                            <h5 style="color: blue;">
                                                {{ $reply->user->name }}
                                            </h5>
                                        @endif
                                        <p>{{ $reply->konten }}</p>
                                        <h6 class="timestamp small mt-3">{{ $reply->created_at->diffForHumans() }}</h6>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
                <hr>
            @endforeach

        </div>
    </section><!-- End F.A.Q Section -->

    <style>
        /* Tambahkan style untuk mengatur tampilan foto profil dan nama pengguna */
        .row .col-auto {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            margin-left: 10px;
        }

        .testimonial-img {
            border-radius: 50%;
        }

        .ml-6 {
            margin-left: 6rem;
        }

        .ml-9 {
            margin-left: 9rem;
        }
    </style>
    <script>
        function toggleKomentar() {
            var textarea = document.getElementById('komentar-utama');
            var komentarContainer = document.getElementById('komentar-container');

            if (textarea.style.display === 'none') {
                textarea.style.display = 'block';
                komentarContainer.style.display = 'block';
            } else {
                textarea.style.display = 'none';
                komentarContainer.style.display = 'none';
            }
        }
    </script>
@endsection
