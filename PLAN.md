### Tools
- [ ] psalm - static analysis (NPR, dead code, type mismatch,...)
- [ ] php-cs-fixer - formatting
- [ ] phpmd - code complexity, code smell 
- [ ] 1 simple test on PHPUnit

### Get familiar with
- [ ] Laravel
    - [ ] Relations
    - [ ] Migrations

### Action
- [ ] Step 1. Entities, migrations  **1 branch, each point is a commit**
    - [ ] Create User
    - [ ] Create Vault
    - [ ] Create Password
    - [ ] Create SharedAccess (polymorph relation to password or vault, can have time based limit or count based limit)
    - [ ] Create a Pull Request and sync

- [ ] Step 2. Configuration of API for User.
    - [ ] list (with pagination)
    - [ ] get
    - [ ] post (create)
    - [ ] put (update) (put requires full payload, patch can go with partial payload)

- [ ] Step 3. Configure Vault and Password API.
    - One vault **hasMany** passwords
    - One password **belongsToOne** vault
    - User hasMany vaults
    - Vault belongsToOne User   

- [ ] Step 4. Configure SharedAccess API
    - User hasMany SharedAcesses (as host)
    - User hasMany SharedAccess (as guest)
    - SharedAccess hasMany Vaults (host can give access to many vaults to one or more guests)
    - Vault belongsToMany SharedAcesses (vault can be shared multiple times)
 
- [ ] Step 5. Auth, JWT, Rate limmit, IP based access

- [ ] Step 6. ACL - access control layer (Roles and permission)

- [ ] Step 8. Mailhog and mail sending (SharedAccess should be activated only if it was accepted though an email)

- [ ] Step 7. To be discussed

### Stuff I would like to learn
 - [ ] Configre CI/CD on github (on PR run tests, code quality check)
 - [ ] configure xdebuger with docker
 - [ ] configure nginx and php-fpm containers for current project
 - [ ] Discuss gitflow, create releases, tags and integrate it with Github CI/CD
 - [ ] Get familiar with AWS
    - [ ] EC2
        - [ ] Security groups
        - [ ] VPC
    - [ ] S3
    - [ ] RDS
    - [ ] CloudWatch
    - [ ] Parameter Store
    - [ ] CodeBuild + CodePipeline
    - [ ] Fargate
