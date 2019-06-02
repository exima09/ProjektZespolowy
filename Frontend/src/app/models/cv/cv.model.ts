import {SickLeave} from "../sick-leave/sickLeave.model";
import {Execution} from "../execution/execution.model";
import {User} from "../user/user.model";
import {Department} from "../department/department.model";
import {JailJobSchedule} from "../jail-job-schedule/jail-job-schedule";
import { applicationStatus } from "./applicationStatus.model";

export class Cv {
  id?: number;
  applicationStatus: applicationStatus;
  firstName: string;
  lastName: string;
  phoneNumber: string;
  email: string;
  fileUrl: string;
}

