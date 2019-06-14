import { Component, OnInit } from '@angular/core';
import {Alarm} from "../../../models/alarm/alarm.model";
import {Worker} from "../../../models/worker/worker.model";
import {AlarmService} from "../../../services/alarm/alarm.service";

@Component({
  selector: 'app-alarm',
  templateUrl: './alarm.component.html',
  styleUrls: ['./alarm.component.css']
})
export class AlarmComponent implements OnInit {
  headerOfSite = 'Alarm więzienny';
  alarms: Alarm[] = [];

  constructor(private service: AlarmService) { }

  ngOnInit() {
    this.getAlarmList();
  }

  getAlarmList = () => this.service.getAlarmList().subscribe((res:any)=> this.alarms = JSON.parse(res.alarms));

  getFullName = (worker: Worker) => worker ? `${worker.user.firstName} ${worker.user.lastName}` : '';
}
