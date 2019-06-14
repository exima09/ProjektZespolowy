import { Component, OnInit } from '@angular/core';
import {AlarmService} from "../../services/alarm/alarm.service";
import {Observable} from "rxjs";
import {AuthenticationService} from "../../services/authorization.service";

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css']
})
export class HeaderComponent implements OnInit {
  isAlarm?: boolean = undefined;
  isLoggedUser: Observable<boolean>;
  constructor(private alarmService: AlarmService, private authService: AuthenticationService) { }

  ngOnInit() {
    this.getStatusAlarm();
    this.isLoggedUser = this.authService.isLoggedIn;
  }

  activateAlarm = () => {
    this.alarmService.alarmStart().subscribe(null,null,()=>this.getStatusAlarm());
  };

  deactivatedAlarm = () => {
    this.alarmService.alarmStop().subscribe(null,null,()=>this.getStatusAlarm());
  };

  getStatusAlarm = () => {
    this.alarmService.getIsAlarmActive().subscribe((res: any) => {
      this.isAlarm = JSON.parse(res.isAlarmActive);
    });
  }

}
