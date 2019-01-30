import {Component, OnInit} from '@angular/core';
import {PrisonerService} from "../../../../services/prisoner/prisoner.service";
import {Prisoner} from "../../../../models/prisoner/prisoner.model";
import {AuthenticationService} from "../../../../services/authorization.service";

@Component({
  selector: 'app-prisoners-list',
  templateUrl: './prisoners-list.component.html',
  styleUrls: ['./prisoners-list.component.css']
})
export class PrisonersListComponent implements OnInit {
  headerOfSite = 'Więźniowie';
  prisoners: Prisoner[] = [];
  constructor(private service: PrisonerService, private auth: AuthenticationService) {
  }

  ngOnInit() {
    this.auth.checkLogin();
    this.service.getPrisoners().subscribe((res: any) => {
      this.prisoners = res.prisoners;
    });
  }
}
