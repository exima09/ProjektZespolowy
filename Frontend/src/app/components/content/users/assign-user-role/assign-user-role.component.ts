import { Component, OnInit, Input } from '@angular/core';
import { Role } from 'src/app/models/role/role';

@Component({
  selector: 'app-assign-user-role',
  templateUrl: './assign-user-role.component.html',
  styleUrls: ['./assign-user-role.component.css']
})
export class AssignUserRoleComponent implements OnInit {
  headerOfSite = "Przypisywanie ról użytkownikowi";
  users = [];
  allRoles: { key, value }[] = [];
  roles = [];
  constructor() { }

  ngOnInit() {
    this.getRoles();
    console.log(this.allRoles);
  }
  getRoles() {
    for (let role in Role) {
      this.allRoles.push({ key: role, value: Role[role] });
    }
  }

  addRole(value) {
    if (this.roles.includes(value)) {
      this.roles = this.roles.filter(elem => {
        if (elem === value) {
          return null;
        } else {
          return elem;
        }
      });
    } else {
      this.roles.push(value);
    }
    console.log(this.roles);
  }
  onSubmit(form) {
  //TODO Requests
  }
}
