-- Hanya data (INSERT). Pastikan tabel sudah ada dari migrasi.
-- Contoh minimal, tambahkan sesuai kebutuhanmu.

INSERT INTO categories (id, name, created_at, updated_at) VALUES
(1,'Sembako',NOW(),NOW()),
(2,'Jajanan',NOW(),NOW()),
(3,'Minuman',NOW(),NOW()),
(4,'Kerajinan',NOW(),NOW())
ON DUPLICATE KEY UPDATE name=VALUES(name), updated_at=VALUES(updated_at);

INSERT INTO products (name, price, stock, category_id, created_at, updated_at) VALUES
('Beras 5kg',120000,50,1,NOW(),NOW()),
('Keripik Singkong',12000,100,2,NOW(),NOW()),
('Air Mineral 600ml',4000,250,3,NOW(),NOW())
ON DUPLICATE KEY UPDATE price=VALUES(price), stock=VALUES(stock), updated_at=VALUES(updated_at);