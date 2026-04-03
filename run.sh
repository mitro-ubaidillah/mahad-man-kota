for file in $(find resources/views -name "create.blade.php" -o -name "edit.blade.php"); do
    sed -i '' 's/id="name"/id="name" placeholder="Masukkan nama lengkap"/g' $file
    sed -i '' 's/id="email"/id="email" placeholder="Masukkan alamat email"/g' $file
    sed -i '' 's/id="phone"/id="phone" placeholder="Masukkan nomor HP aktif"/g' $file
    sed -i '' 's/id="password"/id="password" placeholder="Masukkan password"/g' $file
    sed -i '' 's/id="password_confirmation"/id="password_confirmation" placeholder="Konfirmasi password"/g' $file
    sed -i '' 's/id="description"/id="description" placeholder="Masukkan deskripsi (opsional)"/g' $file
    sed -i '' 's/id="title"/id="title" placeholder="Masukkan judul"/g' $file
    sed -i '' 's/id="kelas_name"/id="kelas_name" placeholder="Nama kelas baru"/g' $file
done
sh run.sh
rm run.sh
