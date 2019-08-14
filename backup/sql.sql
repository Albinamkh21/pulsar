LOAD DATA INFILE 'c:/temp/pr.csv' 
INTO TABLE temp_products 
FIELDS TERMINATED BY ',' 
ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS;
0
LOAD DATA local INFILE 'C:/ProgramData/MySQL/MySQL Server 5.6/Uploads/pr2.csv' 
INTO TABLE tmp_products
CHARACTER SET UTF8
FIELDS TERMINATED BY ';' 
OPTIONALLY ENCLOSED BY '"'
LINES TERMINATED BY '\n'
IGNORE 1 ROWS






1 собинраем единицы измерения

insert into oc_weight_class_description(title, unit, language_id)
SELECT DISTINCT `units`, `units`,1  FROM `tmp_products`

insert into  oc_weight_class(weight_class_id, value)
select weight_class_id, 1 from  oc_weight_class_description

2 категории

oc_category_description
update `tmp_products` set category_id  = coalesce((select category_id from  oc_category_description cd where cd.name=tmp_products.category),0)

update `tmp_products` set category_id = 78 where category_id = 0


select distinct category, cd.category_id, cd.name from oc_category_description cd left join `tmp_products` p on cd.name=p.category


3
update `tmp_products` set weight_class_id = coalesce((select weight_class_id  from  oc_weight_class_description  cd where cd.unit=tmp_products.units),0)





4 втсавляет товары в две таблицы

sku - articul
upc - year,
ean - gost

delete from oc_product where product_id in (select id from `tmp_products` );
insert into oc_product(product_id, model, sku, upc, ean, price, quantity, location, weight_class_id,
                       stock_status_id,jan, isbn, mpn,
                       image,	manufacturer_id,shipping,points,tax_class_id,date_available,weight,length,width,height,length_class_id,subtract,minimum,sort_order,status,viewed,date_added,date_modified)
select id, model, id, year, gost, 0, cnt,  district, weight_class_id, 
7, '', '', '' ,'',0,0,0,0,now(), 0,0,0,0,0,0,0,0,1,0,now(), now()
FROM `tmp_products`

--description
insert into `oc_product_description`(product_id, name, description, language_id, tag,meta_title,meta_h1,meta_description,meta_keyword)
select id, name, info, 1,'','','','',''  FROM `tmp_products`



5 
insert into   `oc_product_to_category`(product_id, category_id, main_category)
select id, category_id, category_id  FROM `tmp_products`

6
insert into   `oc_product_to_store`(product_id, store_id)
select id, 0  FROM `tmp_products`


Зап.части  Запасные части 
Хоз.товары Хозтовары 

Спец.одежда Спецодежда 

