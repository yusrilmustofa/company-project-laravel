db = db.getSiblingDB('admin');

db.createUser({
  user: 'laravel',
  pwd: 'laravelpassword',
  roles: [
    { role: 'readWrite', db: 'company_profile' },
    { role: 'dbAdmin', db: 'company_profile' }
  ]
});