delete a,b,c,d
FROM wp_posts a
LEFT JOIN wp_term_relationships b ON ( a.ID = b.object_id )
LEFT JOIN wp_postmeta c ON ( a.ID = c.post_id )
LEFT JOIN wp_term_taxonomy d ON ( d.term_taxonomy_id = b.term_taxonomy_id )
LEFT JOIN wp_terms e ON ( e.term_id = d.term_id );


**********************************

truncate wp_posts;
truncate wp_postmeta;
truncate wp_terms;
truncate wp_term_taxonomy;
truncate wp_term_relationships;
truncate media;

update people
set person_post = null, person_img_post = null;

update shows
set show_post = null;

update appearances
set appear_post = null;

truncate people;
truncate appearances;

truncate data_in_records;
update data_in set data_status=0;

**********************************

update data_in_records set data_status=0;
truncate people;
truncate appearances;
truncate media;

**********************************

update data_in set data_status=0;
truncate data_in_records;
truncate people;
truncate appearances;
truncate media;


**********************************

truncate wp_posts;
truncate wp_postmeta;
truncate wp_terms;
truncate wp_term_taxonomy;
truncate wp_term_relationships;
truncate media;

truncate people;
truncate appearances;

update data_in_records set data_status=0;

