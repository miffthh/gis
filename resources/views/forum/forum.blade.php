@extends('layout.templateuser')

@section('container')
    <!-- ======= F.A.Q Section ======= -->
    <section id="faq" class="faq">
        <div class="container" data-aos="fade-up">

            <div class="section-title" data-aos="fade-up">
                <h2>Forum Obrolan</h2>
            </div>

            <!-- Button trigger modal -->
            <div class="d-flex flex-row-reverse">
                <a href="/tambahforum" type="button" class="btn btn-primary btn-sm mb-3" data-aos="fade-up"
                    data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-folder-plus"></i>
                    Tambah Forum
                </a>
            </div>
            @foreach ($forum as $fr)
                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-auto">
                        @if ($fr->user && $fr->user->profile_image)
                            <!-- Menampilkan gambar profil pengguna jika tersedia -->
                            <img src="{{ asset('storage/' . $fr->user->profile_image) }}" class="testimonial-img"
                                alt="Foto Profil" height="50px">
                        @else
                            <!-- Menampilkan gambar default jika tidak ada gambar profil -->
                            <img src="{{ asset('storage/profile_images/default/user.png') }}" class="testimonial-img"
                                alt="Foto Profil" height="50px">
                        @endif
                    </div>
                    <div class="col">
                        <a href="{{ route('view', $fr->id) }}">{{ $fr->user->name ?? 'User' }} : {{ $fr->judul }}</a>
                        <p>
                            <span class="text-black">{{ $fr->konten }}</span>
                            <br>
                            <span class="timestamp small">{{ $fr->created_at->diffForHumans() }}</span>
                        </p>
                        <span> Jumlah Komentar :&nbsp;{{ $fr->komentar()->count() }} </span>

                        {{-- <button class="btn btn-default like-button" data-forum-id="{{ $fr->id }}"
                            data-liked="{{ $fr->isLikedByUser(auth()->user()) ? 'true' : 'false' }}">
                            <i class="ri-thumb-up-line"></i>
                            @if ($fr->isLikedByUser(auth()->user()))
                                Unlike
                            @else
                                Like
                            @endif
                        </button> --}}
                        {{-- <span class="total-like" data-forum-id="{{ $fr->id }}">{{ $fr->likes()->count() }}</span>
                        orang menyukai ini --}}
                        {{-- <div class="mt-3">
                            @if (auth()->check() && (auth()->user()->id === $fr->user_id || in_array(auth()->user()->role, ['Admin', 'Wisata', 'Penginapan', 'Resto'])))
                                <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModalEditForum-{{ $fr->id }}">Edit</a>
                            @endif

                            <!-- Tombol Hapus Forum -->

                            @if (auth()->check() && (auth()->user()->id === $fr->user_id || auth()->user()->role === 'Admin'))
                                <a href="#" type="button" class="btn btn-danger btn-sm hapus-forum" data-id="{{ $fr->id }}" data-nama="{{ $fr->judul }}">Hapus</a>
                            @endif
                        </div> --}}

                    </div>
                </div>
                <hr>
            @endforeach

        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Forum</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ 'aksi_tambah_forum' }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 mt-3">
                                <label for="judul">Judul</label>
                                <input type="text" name="judul" class="form-control" id="judul"
                                    aria-describedby="emailHelp" value="{{ old('judul') }}">
                            </div>
                            <div class="mb-3">
                                <label for="konten">Konten</label>
                                <textarea type="text" name="konten" class="form-control" id="konten" rows="5" aria-describedby="emailHelp"
                                    value="{{ old('konten') }}" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-secondary mt-3"><i class="bi bi-save2"></i>
                                Simpan</button>
                            <a type="button" href="/baatal" class="btn btn-info mt-3">Batal</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @foreach ($forum as $fr)
            <!-- Modal Edit Forum -->
            <div class="modal fade" id="exampleModalEditForum-{{ $fr->id }}" tabindex="-1"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Forum</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('aksi_edit_forum', $fr->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <!-- Gunakan metode POST untuk mengedit forum -->
                                <div class="mb-3 mt-3">
                                    <label for="judul">Judul</label>
                                    <input type="text" name="judul" class="form-control" id="judul"
                                        aria-describedby="emailHelp" value="{{ $fr->judul }}">
                                </div>
                                <div class="mb-3">
                                    <label for="konten">Konten</label>
                                    <textarea type="text" name="konten" class="form-control" id="konten" rows="5"
                                        aria-describedby="emailHelp" required>{{ $fr->konten }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-secondary mt-3"><i class="bi bi-save2"></i>
                                    Simpan</button>
                                <a type="button" href="/baatal" class="btn btn-info mt-3"
                                    data-bs-dismiss="modal">Batal</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </section><!-- End F.A.Q Section -->

    {{-- @push('append-script') --}}
    <script>
        // document.addEventListener('DOMContentLoaded', function() {
        //     var likeButtons = document.querySelectorAll('.like-button');
        //     var totalLikes = document.querySelectorAll('.total-like');

        //     likeButtons.forEach(function(likeButton) {
        //         var forumId = likeButton.getAttribute('data-forum-id');
        //         var liked = localStorage.getItem('liked-' + forumId);

        //         if (liked === 'true') {
        //             likeButton.innerHTML = '<i class="ri-thumb-up-fill"></i> ';
        //         } else {
        //             likeButton.innerHTML = '<i class="ri-thumb-up-line"></i> ';
        //         }

        //         likeButton.addEventListener('click', function() {
        //             var forumId = this.getAttribute('data-forum-id');
        //             var liked = localStorage.getItem('liked-' + forumId);

        //             fetch('/forum/like', {
        //                     method: 'POST',
        //                     headers: {
        //                         'Content-Type': 'application/json',
        //                         'X-CSRF-TOKEN': '{{ csrf_token() }}'
        //                     },
        //                     body: JSON.stringify({
        //                         forum_id: forumId,
        //                         liked: liked === 'true' ? 'false' :
        //                             'true' // Toggle liked status
        //                     })
        //                 })
        //                 .then(response => response.json())
        //                 .then(data => {
        //                     totalLikes.forEach(function(totalLike) {
        //                         if (totalLike.getAttribute('data-forum-id') ===
        //                             forumId) {
        //                             totalLike.textContent = data.total_like;
        //                         }
        //                     });

        //                     if (liked === 'true') {
        //                         likeButton.innerHTML = '<i class="ri-thumb-up-line"></i> ';
        //                     } else {
        //                         likeButton.innerHTML = '<i class="ri-thumb-up-fill"></i> ';
        //                     }
        //                     localStorage.setItem('liked-' + forumId, liked === 'true' ?
        //                         'false' : 'true'); // Update liked status
        //                 })
        //                 .catch(error => console.error(error));
        //         });
        //     });
        // });


        $('.hapus-forum').click(function() {
            var forumid = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');


            swal({
                    title: "Apakah Yakin ?",
                    text: "Data dengan nama " + nama + " akan dihapus!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = "/forum/" + forumid + ""
                        swal("Data berhasil dihapus!", {
                            icon: "success",
                        });
                    } else {
                        swal("Data tidak jadi dihapus!");
                    }
                });

        });
    </script>
    {{-- @endpush --}}
@endsection
