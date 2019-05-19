import {SickLeave} from "../sick-leave/sickLeave.model";
import {Execution} from "../execution/execution.model";
import {User} from "../user/user.model";
import {Department} from "../department/department.model";
import {JailJobSchedule} from "../jail-job-schedule/jail-job-schedule";

export class Worker {
  id?: number;
  user: User;
  salary: number;
  bonus: number;
  dateFrom: string;
  dateTo?: string;
  sickLeaves: SickLeave[];
  department: Department;
  execution: Execution[];
  jailJobSchedules: JailJobSchedule[];
}

