import { Component, OnInit } from '@angular/core';
import {User} from "../../../../models/user/user.model";
import {Worker} from "../../../../models/worker/worker.model";
import {WorkerService} from "../../../../services/worker/worker.service";

@Component({
  selector: 'app-user-roles',
  templateUrl: './user-roles.component.html',
  styleUrls: ['./user-roles.component.css']
})
export class UserRolesComponent implements OnInit {
  headerOfSite = "Lista użytkowników";
  users: User[] = [];
  usersWorker: User[] = [];
  usersAll: User[] = [];


  constructor(private service: WorkerService) {
  }
  ngOnInit() {
    this.getUsers();
  }

  getUsers = () => this.service.getUsers().subscribe(
    (res:any) => {
      this.usersAll = JSON.parse(res.users);
      this.usersWorker = this.usersAll.filter(user=>user.worker);
      this.users = this.usersAll.filter(user=>!user.worker);
    });

  checkWorker = (worker: Worker) => worker ? `Pracownik - ${worker.department.departmentName}` : "Użytkownik";

}

