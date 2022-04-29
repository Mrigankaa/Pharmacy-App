create table gst(
    gst_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    gst_amount decimal(10,2) NOT NULL,
);

CREATE TABLE rack(
    rack_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    rack_number varchar NOT NULL
);

CREATE TABLE category(
    cat_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    cat_type varchar(50),
);

CREATE TABLE medicine(
    med_id int(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    med_name varchar(255) NOT NULL,
    HSN_number varchar(50) NOT NULL,
    purchase_price decimal(10,2) NOT NULL,
    sell_price decimal(10,2) NOT NULL,
    quantity int(11) NOT NULL,
    menufature_date date,
    expiry_date date,
    batch_id int(11) NOT NULL,
    gst_id int(11) NOT NULL,
    cat_id int(11) NOT NULL,
    rack_id int(11) NOT NULL,
    supplier_id int(11) NOT NULL
);

CREATE table supplier(
    s_id int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    s_name varchar(255),
    s_email varchar(255),
    s_phone varchar(10),
    s_address varchar(255)
);